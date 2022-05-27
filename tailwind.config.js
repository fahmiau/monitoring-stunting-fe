module.exports = {
  content: [
    "./resources/**/*.blade.php",
    "./resources/**/*.js",
    "./resources/**/*.vue",
  ],
  theme: {
    extend: {
      colors: {
        'primary': '#55D6C2',
        'secondary': '#2B2D42',
        'swhite' : '#F2FCF5'
      },
    },
  },
  plugins: [
    require('@tailwindcss/forms'),
  ],
}
