// vite.config.js
import { defineConfig } from 'vite'

export default defineConfig({
	base: "/wp-content/themes/beth-gutenberg/assets/dist/",
	build: {
		assetsDir: "",
		outDir: "./assets/dist/",
		rollupOptions: {
			input: "./assets/src/js/main.js",
			output: {
				entryFileNames: `[name].js`,
        chunkFileNames: `[name].js`,
        assetFileNames: `[name].[ext]`
			}
		}
	},
  css: {
    preprocessorOptions: {
      scss: {}
    }
  }
})