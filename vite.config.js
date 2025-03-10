import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/css/app.css',
                'resources/js/app.js',
            ],
            refresh: true,
        }),
    ],
   
  // server: {
  //   watch: {
  //     usePolling: true,
  //   },
  
  //   host: true,
  //   strictPort: true,
  //   port: 5173,

  //   hmr: {
  //     host: 'localhost', // или IP машины хоста, если Vite должен быть доступен из контейнера nginx
  //   },
  // },

  server: {
    host: '0.0.0.0', // Чтобы Vite слушал все IP внутри Docker
    port: 5173,
    hmr: {
        host: 'localhost', // или твой IP хоста, если работаешь не на localhost
    },
    cors: true, // включаем CORS
},


});
