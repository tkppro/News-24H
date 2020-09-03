export const datePlugin = {
    install(Vue, options) {
        Vue.prototype.convertDateString = function(date) {    
            if(date) {  
                let d = new Date(date);
        
                return d.toDateString();
            }  
        };
    },
}