     if (!String.prototype.trim) {
          String.prototype.trim = function () {
                return this.replace(/^[\s\uFEFF\xA0]+|[\s\uFEFF\xA0]+$/g, '');
              };
      }
    
        if (!String.prototype.includes) {
            String.prototype.includes = function() {
                'use strict';
                return String.prototype.indexOf.apply(this, arguments) !== -1;
            };
        }