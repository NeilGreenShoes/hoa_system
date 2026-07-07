
document.addEventListener('DOMContentLoaded', () => {
    const toast = document.querySelector('.message-container');
    
    if (toast) {
        setTimeout(() => {
            toast.classList.add('hide');
            
            toast.addEventListener('animationend', (e) => {
                
                if (e.animationName === 'slideOutRight' || e.animationName === 'slideInRight') {
                    toast.remove();
                }
            });

            setTimeout(() => {
                if (toast.parentNode) toast.remove();
            }, 500);

        }, 4000);
    }
});