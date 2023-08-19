const defaultTheme = require('tailwindcss/defaultTheme');
const colors = require('tailwindcss/colors');

module.exports = {
    mode: 'jit',
    purge: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './vendor/laravel/jetstream/**/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ['Noto Sans', ...defaultTheme.fontFamily.sans],
                display: ['Montserrat'],
            },

            colors: {
                yellow: {
                    250: '#FCDD03',
                    450: '#FCDD03',
                    750: '#F9BA06',
                }, 
                blue: {
                    250: '#61BCED',
                    450: '#21A1E8',
                    750: '#1F98DB',
                  }
            }
        },

        colors: {
            transparent: 'transparent',
            current: 'currentColor',
            white: colors.white,
            gray: colors.gray,
            blueGray: colors.blueGray,
            name: colors.coolGray,
            trueGray: colors.trueGray,
            warmGray: colors.warmGray,
            yellow: colors.yellow,
            orange: colors.orange,
            amber: colors.amber,
            red: colors.red,
            lime: colors.lime,
            emerald: colors.emerald,
            green: colors.green,
            teal: colors.teal,
            cyan: colors.cyan,
            lightBlue: colors.lightBlue,
            indigo: colors.indigo,
            pink: colors.pink,
            rose: colors.rose,
            purple: colors.purple,
            violet: colors.violet,
            fuchsia: colors.fuchsia,
            blue: colors.blue,

        },
    },

    variants: {
        extend: {
            opacity: ['disabled'],
        },
    },

    plugins: [require('@tailwindcss/forms'), require('@tailwindcss/typography')],
};
