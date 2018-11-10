window.app = {
    init: (modules) => {
      modules.forEach(module => {
        if (typeof app[module] !== 'undefined') {
          app[module].init();
        }
      })
    }
}