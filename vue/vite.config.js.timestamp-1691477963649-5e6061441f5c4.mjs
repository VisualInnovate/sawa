// vite.config.js
import { defineConfig } from "file:///D:/projects/sawa_academy/vue/node_modules/vite/dist/node/index.js";
import vue from "file:///D:/projects/sawa_academy/vue/node_modules/@vitejs/plugin-vue/dist/index.mjs";
import VueI18nPlugin from "file:///D:/projects/sawa_academy/vue/node_modules/@intlify/unplugin-vue-i18n/lib/vite.mjs";
import vuetify from "file:///D:/projects/sawa_academy/vue/node_modules/vite-plugin-vuetify/dist/index.js";
import { fileURLToPath } from "node:url";
import { resolve, dirname } from "node:path";
var __vite_injected_original_dirname = "D:\\projects\\sawa_academy\\vue";
var __vite_injected_original_import_meta_url = "file:///D:/projects/sawa_academy/vue/vite.config.js";
var vite_config_default = defineConfig({
  resolve: {
    alias: {
      "@": resolve(__vite_injected_original_dirname, "./src")
    }
  },
  plugins: [
    vue(),
    // this plugin is imported for treeshaking -- small chunk size for build whenever its required
    vuetify({
      autoImport: true,
      treeShake: true
      // styles: { configFile: './src/settings.scss' }
      // styles: { configFile: 'src/settings.scss' }
      // styles: 'expose'
      // styles: 'sass'
    }),
    // Enabled by default
    // added this vueI18nPlugin to define locales
    VueI18nPlugin({
      include: resolve(
        dirname(fileURLToPath(__vite_injected_original_import_meta_url)),
        "./src/locales/*.js"
      )
    })
  ],
  server: {
    port: 3e3
  },
  /**
   * when build can be used to define admin entry point and forntend website entry point
   */
  build: {
    rollupOptions: {
      input: {
        main: resolve(__vite_injected_original_dirname, "index.html")
        // admin: resolve(__dirname, 'admin/index.html'),
      }
    }
  }
  // build: {
  //   outDir: '../laravel/public'
  // }
});
export {
  vite_config_default as default
};
//# sourceMappingURL=data:application/json;base64,ewogICJ2ZXJzaW9uIjogMywKICAic291cmNlcyI6IFsidml0ZS5jb25maWcuanMiXSwKICAic291cmNlc0NvbnRlbnQiOiBbImNvbnN0IF9fdml0ZV9pbmplY3RlZF9vcmlnaW5hbF9kaXJuYW1lID0gXCJEOlxcXFxwcm9qZWN0c1xcXFxzYXdhX2FjYWRlbXlcXFxcdnVlXCI7Y29uc3QgX192aXRlX2luamVjdGVkX29yaWdpbmFsX2ZpbGVuYW1lID0gXCJEOlxcXFxwcm9qZWN0c1xcXFxzYXdhX2FjYWRlbXlcXFxcdnVlXFxcXHZpdGUuY29uZmlnLmpzXCI7Y29uc3QgX192aXRlX2luamVjdGVkX29yaWdpbmFsX2ltcG9ydF9tZXRhX3VybCA9IFwiZmlsZTovLy9EOi9wcm9qZWN0cy9zYXdhX2FjYWRlbXkvdnVlL3ZpdGUuY29uZmlnLmpzXCI7aW1wb3J0IHsgZGVmaW5lQ29uZmlnIH0gZnJvbSBcInZpdGVcIjtcclxuaW1wb3J0IHZ1ZSBmcm9tIFwiQHZpdGVqcy9wbHVnaW4tdnVlXCI7XHJcbmltcG9ydCBWdWVJMThuUGx1Z2luIGZyb20gXCJAaW50bGlmeS91bnBsdWdpbi12dWUtaTE4bi92aXRlXCI7XHJcbmltcG9ydCB2dWV0aWZ5IGZyb20gXCJ2aXRlLXBsdWdpbi12dWV0aWZ5XCI7XHJcbmltcG9ydCB7IGZpbGVVUkxUb1BhdGggfSBmcm9tIFwibm9kZTp1cmxcIjtcclxuaW1wb3J0IHsgcmVzb2x2ZSwgZGlybmFtZSB9IGZyb20gXCJub2RlOnBhdGhcIjtcclxuXHJcbi8vIGh0dHBzOi8vdml0ZWpzLmRldi9jb25maWcvXHJcbmV4cG9ydCBkZWZhdWx0IGRlZmluZUNvbmZpZyh7XHJcbiAgcmVzb2x2ZToge1xyXG4gICAgYWxpYXM6IHtcclxuICAgICAgXCJAXCI6IHJlc29sdmUoX19kaXJuYW1lLCBcIi4vc3JjXCIpLFxyXG4gICAgfSxcclxuICB9LFxyXG4gIHBsdWdpbnM6IFtcclxuICAgIHZ1ZSgpLFxyXG4gICAgLy8gdGhpcyBwbHVnaW4gaXMgaW1wb3J0ZWQgZm9yIHRyZWVzaGFraW5nIC0tIHNtYWxsIGNodW5rIHNpemUgZm9yIGJ1aWxkIHdoZW5ldmVyIGl0cyByZXF1aXJlZFxyXG4gICAgdnVldGlmeSh7XHJcbiAgICAgIGF1dG9JbXBvcnQ6IHRydWUsXHJcbiAgICAgIHRyZWVTaGFrZTogdHJ1ZSxcclxuXHJcbiAgICAgIC8vIHN0eWxlczogeyBjb25maWdGaWxlOiAnLi9zcmMvc2V0dGluZ3Muc2NzcycgfVxyXG4gICAgICAvLyBzdHlsZXM6IHsgY29uZmlnRmlsZTogJ3NyYy9zZXR0aW5ncy5zY3NzJyB9XHJcbiAgICAgIC8vIHN0eWxlczogJ2V4cG9zZSdcclxuICAgICAgLy8gc3R5bGVzOiAnc2FzcydcclxuICAgIH0pLCAvLyBFbmFibGVkIGJ5IGRlZmF1bHRcclxuICAgIC8vIGFkZGVkIHRoaXMgdnVlSTE4blBsdWdpbiB0byBkZWZpbmUgbG9jYWxlc1xyXG4gICAgVnVlSTE4blBsdWdpbih7XHJcbiAgICAgIGluY2x1ZGU6IHJlc29sdmUoXHJcbiAgICAgICAgZGlybmFtZShmaWxlVVJMVG9QYXRoKGltcG9ydC5tZXRhLnVybCkpLFxyXG4gICAgICAgIFwiLi9zcmMvbG9jYWxlcy8qLmpzXCJcclxuICAgICAgKSxcclxuICAgIH0pLFxyXG4gIF0sXHJcbiAgc2VydmVyOiB7XHJcbiAgICBwb3J0OiAzMDAwLFxyXG4gIH0sXHJcbiAgLyoqXHJcbiAgICogd2hlbiBidWlsZCBjYW4gYmUgdXNlZCB0byBkZWZpbmUgYWRtaW4gZW50cnkgcG9pbnQgYW5kIGZvcm50ZW5kIHdlYnNpdGUgZW50cnkgcG9pbnRcclxuICAgKi9cclxuICBidWlsZDoge1xyXG4gICAgcm9sbHVwT3B0aW9uczoge1xyXG4gICAgICBpbnB1dDoge1xyXG4gICAgICAgIG1haW46IHJlc29sdmUoX19kaXJuYW1lLCBcImluZGV4Lmh0bWxcIiksXHJcbiAgICAgICAgLy8gYWRtaW46IHJlc29sdmUoX19kaXJuYW1lLCAnYWRtaW4vaW5kZXguaHRtbCcpLFxyXG4gICAgICB9LFxyXG4gICAgfSxcclxuICB9LFxyXG4gIC8vIGJ1aWxkOiB7XHJcbiAgLy8gICBvdXREaXI6ICcuLi9sYXJhdmVsL3B1YmxpYydcclxuICAvLyB9XHJcbn0pO1xyXG4iXSwKICAibWFwcGluZ3MiOiAiO0FBQThRLFNBQVMsb0JBQW9CO0FBQzNTLE9BQU8sU0FBUztBQUNoQixPQUFPLG1CQUFtQjtBQUMxQixPQUFPLGFBQWE7QUFDcEIsU0FBUyxxQkFBcUI7QUFDOUIsU0FBUyxTQUFTLGVBQWU7QUFMakMsSUFBTSxtQ0FBbUM7QUFBOEgsSUFBTSwyQ0FBMkM7QUFReE4sSUFBTyxzQkFBUSxhQUFhO0FBQUEsRUFDMUIsU0FBUztBQUFBLElBQ1AsT0FBTztBQUFBLE1BQ0wsS0FBSyxRQUFRLGtDQUFXLE9BQU87QUFBQSxJQUNqQztBQUFBLEVBQ0Y7QUFBQSxFQUNBLFNBQVM7QUFBQSxJQUNQLElBQUk7QUFBQTtBQUFBLElBRUosUUFBUTtBQUFBLE1BQ04sWUFBWTtBQUFBLE1BQ1osV0FBVztBQUFBO0FBQUE7QUFBQTtBQUFBO0FBQUEsSUFNYixDQUFDO0FBQUE7QUFBQTtBQUFBLElBRUQsY0FBYztBQUFBLE1BQ1osU0FBUztBQUFBLFFBQ1AsUUFBUSxjQUFjLHdDQUFlLENBQUM7QUFBQSxRQUN0QztBQUFBLE1BQ0Y7QUFBQSxJQUNGLENBQUM7QUFBQSxFQUNIO0FBQUEsRUFDQSxRQUFRO0FBQUEsSUFDTixNQUFNO0FBQUEsRUFDUjtBQUFBO0FBQUE7QUFBQTtBQUFBLEVBSUEsT0FBTztBQUFBLElBQ0wsZUFBZTtBQUFBLE1BQ2IsT0FBTztBQUFBLFFBQ0wsTUFBTSxRQUFRLGtDQUFXLFlBQVk7QUFBQTtBQUFBLE1BRXZDO0FBQUEsSUFDRjtBQUFBLEVBQ0Y7QUFBQTtBQUFBO0FBQUE7QUFJRixDQUFDOyIsCiAgIm5hbWVzIjogW10KfQo=
