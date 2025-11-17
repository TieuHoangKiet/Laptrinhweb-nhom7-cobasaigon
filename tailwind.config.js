/** @type {import('tailwindcss').Config} */
export default {
  content: [
    "./resources/**/*.blade.php", // Quét tất cả file Blade trong resources/views
    "./resources/**/*.js",       // Quét file JS nếu cần
    "./resources/**/*.vue",      // Quét file Vue nếu dùng
  ],
  theme: {
    extend: {},
  },
  plugins: [],
}