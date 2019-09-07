module.exports = {
    theme: {
        extend: {
            borderRadius: {
                'xl': '1rem',
            },
            inset: {
                '5': '2rem',
            },
            minHeight: {
                'hero': '7.5rem',
            },
            colors: {
                'black-t-10': 'rgba(0,0,0,0.1)',
                'black-t-20': 'rgba(0,0,0,0.2)',
                'black-t-30': 'rgba(0,0,0,0.3)',
                'black-t-40': 'rgba(0,0,0,0.4)',
                'black-t-50': 'rgba(0,0,0,0.5)',
                'black-t-60': 'rgba(0,0,0,0.6)',
                'black-t-70': 'rgba(0,0,0,0.7)',
                'black-t-80': 'rgba(0,0,0,0.8)',
                'black-t-90': 'rgba(0,0,0,0.9)',
            },
        },
        aspectRatio: {
          'square': [1, 1],
          '16/9': [16, 9],
        },
        customForms: theme => ({
            default: {
                input: {
                    backgroundColor: theme('colors.blue.100'),
                    borderColor: theme('colors.blue.400'),
                    borderRadius: theme('borderRadius.none'),
                    '&:focus': {
                        outline: 'none',
                        boxShadow: theme('boxShadow.none'),
                        borderColor: theme('colors.blue.700'),
                    },
                },
                textarea: {
                    backgroundColor: theme('colors.blue.100'),
                    borderColor: theme('colors.blue.400'),
                    borderRadius: theme('borderRadius.none'),
                    '&:focus': {
                        outline: 'none',
                        boxShadow: theme('boxShadow.none'),
                        borderColor: theme('colors.blue.700'),
                    },
                },
                multiselect: {
                    backgroundColor: theme('colors.blue.100'),
                    borderColor: theme('colors.blue.400'),
                    borderRadius: theme('borderRadius.none'),
                    '&:focus': {
                        outline: 'none',
                        boxShadow: theme('boxShadow.none'),
                        borderColor: theme('colors.blue.700'),
                    },
                },
                select: {
                    backgroundColor: theme('colors.blue.100'),
                    borderColor: theme('colors.blue.400'),
                    borderRadius: theme('borderRadius.none'),
                    '&:focus': {
                        outline: 'none',
                        boxShadow: theme('boxShadow.none'),
                        borderColor: theme('colors.blue.700'),
                    },
                },
                checkbox: {
                    color: theme('colors.purple.700'),
                },
                radio: {
                    color: theme('colors.purple.700'),
                    // '&:focus': {
                    //     outline: 'none',
                    //     boxShadow: defaultTheme.boxShadow.outline,
                    //     borderColor: defaultTheme.colors.blue[400],
                    // },
                }
            },
        }),
    },
    variants: {},
    plugins: [
        require('@tailwindcss/custom-forms'),
        require('tailwindcss-aspect-ratio')(),
    ]
}
