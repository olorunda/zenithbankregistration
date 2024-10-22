/** @type {import('tailwindcss').Config} */
module.exports = {
    content: [
        "./resources/**/*.blade.php",
        "./resources/**/*.js",
        "./resources/**/*.vue",
    ],
    theme: {
        container: {
            center: true
        },
        fontFamily: {
            'Poppins': ['Poppins', 'sans-serif']
        },
        extend: {},
    },
    plugins: [
        require('@tailwindcss/forms'),
    ],
}

