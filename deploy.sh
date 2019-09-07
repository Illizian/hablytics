#!/usr/bin/env bash
set -e

# Add Remote Host SSH Key to SSH Agent
(umask  077 ; mkdir -p ~/.ssh ; echo "$SSH_PRIVATE_KEY" | base64 -d > ~/.ssh/id_rsa)
eval "$(ssh-agent -s)"
ssh-add ~/.ssh/id_rsa

# Enable Maintainence Mode on Remote Host (Checks Artisan Exists first!)
ssh -p $SSH_PORT -o StrictHostKeyChecking=no "$SSH_USER@$SSH_HOST" bash -s << BASH
set -e
cd "$SSH_PUBLIC_DIR"
if [ -f "$SSH_PUBLIC_DIR/artisan" ]; then
  php "$SSH_PUBLIC_DIR/artisan" down
fi
BASH

# Rsync the latest version to the Remote Host
rsync -avh --no-compress --delete --ignore-errors --exclude-from '.rsync-ignore' \
  -e "ssh -p $SSH_PORT -o StrictHostKeyChecking=no" ./ "$SSH_USER@$SSH_HOST:$SSH_PUBLIC_DIR"

# Copy the .env file to the Remote Host
ssh -p $SSH_PORT -o StrictHostKeyChecking=no "$SSH_USER@$SSH_HOST" bash -s << BASH
set -e
echo "$ENV_FILE" | base64 -d > "$SSH_PUBLIC_DIR/.env"
BASH

# Run Outstanding Migrations & Clear Caches
ssh -p $SSH_PORT -o StrictHostKeyChecking=no "$SSH_USER@$SSH_HOST" bash -s << BASH
set -e
cd "$SSH_PUBLIC_DIR"
php artisan migrate
php artisan cache:clear
BASH

# Disable Maintainence Mode on Remote Host
ssh -p $SSH_PORT -o StrictHostKeyChecking=no "$SSH_USER@$SSH_HOST" bash -s << BASH
set -e
cd "$SSH_PUBLIC_DIR"
php "$SSH_PUBLIC_DIR/artisan" up
BASH
