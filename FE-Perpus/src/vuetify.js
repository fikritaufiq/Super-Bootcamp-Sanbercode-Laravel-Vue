import { createVuetify } from "vuetify";
import "vuetify/styles"; // Impor gaya Vuetify
import * as components from "vuetify/components";
import * as directives from "vuetify/directives";

const vuetify = createVuetify({
  // Konfigurasi tambahan dapat ditambahkan di sini
  components,
  directives,
  theme: { // Menambahkan tema dengan warna gelap
    themes: {
      dark: {
        primary: '#121212', // Warna primer gelap
        secondary: '#1F1F1F', // Warna sekunder gelap
        accent: '#BB86FC', // Warna aksen gelap
        background: '#000000', // Warna latar belakang gelap
      },
    },
  },
});

export default vuetify;