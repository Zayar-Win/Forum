import { defineConfig } from 'vite'
import laravel from 'laravel-vite-plugin'
import vue from '@vitejs/plugin-vue'
import fs from 'fs'
import path from 'path'

function getPages(dir, files = []) {
  fs.readdirSync(dir).forEach(file => {
    const full = path.join(dir, file)
    if (fs.statSync(full).isDirectory()) getPages(full, files)
    else if (file.endsWith('.vue')) files.push(full)
  })
  return files
}

export default defineConfig({
  plugins: [
    laravel({
      input: [
        'resources/js/app.js',
        ...getPages('resources/js/Pages')   // 👈 auto-register all pages
      ],
      refresh: true,
    }),
    vue(),
  ],
})
