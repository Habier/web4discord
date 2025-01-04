// src/i18n.js
import { createI18n } from 'vue-i18n';

// Import your language files
import en from '../locale/en.json';
import es from '../locale/es.json';

const messages = {
    en,
    es,
};

const i18n = createI18n({
    locale: 'es', // set locale
    fallbackLocale: 'en', // set fallback locale
    messages, // set locale messages
});

export default i18n;
