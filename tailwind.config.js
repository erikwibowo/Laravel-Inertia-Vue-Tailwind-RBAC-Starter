module.exports = {
    content: [
        "./resources/**/*.blade.php",
        "./resources/**/*.js",
        "./resources/**/*.vue",
    ],
    theme: {
        extend: {
            fontFamily: {
                'Nunito': ["Nunito"],
            },
        },
    },
    plugins: [require("@tailwindcss/forms")],
};
