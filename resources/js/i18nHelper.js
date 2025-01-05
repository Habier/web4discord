export function translate(key, params = {}) {
    // Accede al contexto global de i18n
    const instance = getCurrentInstance();
    if (!instance) {
        console.warn('translate() debe usarse dentro de un componente Vue.');
        return key;
    }

    return instance.appContext.config.globalProperties.$t(key, params);
}
