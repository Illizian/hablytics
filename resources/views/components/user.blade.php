<tr class="hover:bg-grey-300">
    <td class="p-2 border-b border-gray-300">
        <p class="text-sm">{{ $user->name }}</p>
        <p class="text-xs">{{ $user->email }}</p>
    </td>

    <td class="p-2 border-b border-gray-300">
        @if($user->email_verified_at)
            <span alt="Email Status" class="pill">Verified</span>
        @else
            <span alt="Email Status" class="pill pill-tertiary">Unverified</span>
        @endif
        <span alt="Diary Count" class="pill">D{{ $user->diaries()->count() }}</span>
        <span alt="Achievement Count" class="pill pill-secondary">A{{ $user->achievements->count() }}</span>
        <span alt="Push Subscription" class="pill">{{ $user->pushSubscriptions()->count() > 0 ? 'Yes' : 'No' }}</span>
    </td>

    <td class="p-2 border-b border-gray-300">
        <form method="POST">
            @csrf
            <input type="hidden" name="user" value="{{ $user->id }}" />

            @if($user->approved)
                <button type="submit" name="action" value="unapprove" class="mb-1 btn btn-sm btn-gray">Unapprove</button>
            @else
                <button type="submit" name="action" value="approve" class="mb-1 btn btn-sm btn-green">Approve</button>
            @endif

            @unless($user->admin)
                <button type="submit" name="action" value="admin" class="mb-1 btn btn-sm">Make Admin</button>
                <button type="submit" name="action" value="delete" class="mb-1 btn btn-sm btn-red">Delete</button>
            @endunless

        </form>
    </td>
</tr>
