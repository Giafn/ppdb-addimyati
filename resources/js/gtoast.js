
window.gtoast = {
    showToast: function(message, type, timeout, idToast = 'toast-container', maxToast = 5) {
        var color = '';
        var icon = '';
        if (typeof timeout === 'undefined') {
            timeout = 3000;
        }
        if (typeof message === 'undefined') {
            message = '';
        }
        if (typeof type === 'undefined') {
            color = 'bg-gray-500 text-white dark:bg-gray-300 dark:text-gray-800';
            
        }
        if (type == 'error') {
            color = 'bg-red-500 text-white dark:bg-red-300 dark:text-red-800';
            icon = `<svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5Zm3.707 11.793a1 1 0 1 1-1.414 1.414L10 11.414l-2.293 2.293a1 1 0 0 1-1.414-1.414L8.586 10 6.293 7.707a1 1 0 0 1 1.414-1.414L10 8.586l2.293-2.293a1 1 0 0 1 1.414 1.414L11.414 10l2.293 2.293Z"/>
                    </svg>
                    <span class="sr-only">Error icon</span>`;
        }
        if (type == 'success') {
            color = 'bg-green-500 text-white dark:bg-green-300 dark:text-green-800';
            icon = `<svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5Zm3.707 8.207-4 4a1 1 0 0 1-1.414 0l-2-2a1 1 0 0 1 1.414-1.414L9 10.586l3.293-3.293a1 1 0 0 1 1.414 1.414Z"/>
                    </svg>
                    <span class="sr-only">Check icon</span>`;
        }
        if (type == 'warning') {
            color = 'bg-yellow-500 text-white dark:bg-yellow-300 dark:text-yellow-800';
            icon = `<svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM10 15a1 1 0 1 1 0-2 1 1 0 0 1 0 2Zm1-4a1 1 0 0 1-2 0V6a1 1 0 0 1 2 0v5Z"/>
                    </svg>
                    <span class="sr-only">Warning icon</span>`;
        }
        if (type == 'info') {
            color = 'bg-blue-500 text-white dark:bg-blue-300 dark:text-blue-800';
            icon = `<svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM10 15a1 1 0 1 1 0-2 1 1 0 0 1 0 2Zm1-4a1 1 0 0 1-2 0V6a1 1 0 0 1 2 0v5Z"/>
                    </svg>
                    <span class="sr-only">Warning icon</span>`;
        }

        var randomId = Math.floor(Math.random() * 1000000000);

        var toastHTML = `<div id="${randomId}" class="shadow-lg flex items-center w-full max-w-xs p-4 mb-4 text-gray-500 bg-white rounded-lg dark:text-gray-400 dark:bg-gray-800" role="alert">
                <div class="inline-flex items-center justify-center flex-shrink-0 w-8 h-8 rounded-lg ${color} sm:w-10 sm:h-10">
                    ${icon}
                </div>
                <div class="ms-3 text-sm font-normal">${message}</div>
                <button type="button" class="ms-auto -mx-1.5 -my-1.5 bg-white text-gray-400 hover:text-gray-900 rounded-lg focus:ring-2 focus:ring-gray-300 p-1.5 hover:bg-gray-100 inline-flex items-center justify-center h-8 w-8 dark:text-gray-500 dark:hover:text-white dark:bg-gray-800 dark:hover:bg-gray-700" onclick="$('#${randomId}').remove()">
                    <span class="sr-only">Close</span>
                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                    </svg>
                </button>
            </div>`;

        let toast = $('#'+idToast);
        if (toast.length == 0) {
            $('body').prepend('<div id="'+idToast+'" class="fixed top-5 right-5 z-100"></div>');
        }
        $('#' + randomId).css('z-index', 999999999);
        if (toast.children().length >= maxToast) {
            toast.children().last().remove();
        }
        $('#' + idToast).prepend(toastHTML);

        setTimeout(function () {
            $('#' + randomId).remove();
        }, timeout);
    }
}
