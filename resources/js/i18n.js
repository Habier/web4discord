// src/i18n.js
import { createI18n } from 'vue-i18n';

// Import your language files
import en from '../locales/en.json';
import es from '../locales/es.json';

const messages = {
    en,
    es,
};

const i18n = createI18n({
    locale: 'es', // set locales
    fallbackLocale: 'en', // set fallback locales
    messages, // set locales messages
});

export default i18n;
