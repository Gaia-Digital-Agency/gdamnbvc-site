const initThankYou = (component) => {
    try {
        const cartId = Cookies.get('_rp_sc')
        if(!cartId) throw 'cart id not found'

        jQuery.ajax({
            method: "POST",
            url: "/wp-admin/admin-ajax.php",
            data: {
                action: "gda_ver_cart",
                cart: Cookies.get('_rp_sc')
            },
            success: (res) => {
                const data = JSON.parse(res)
                if(!data || data.status_code == 'inactive') {
                    window.location.replace('/')
                }
            },
            failed: () => {
                window.location.replace('/')
            }
        })
    } catch(e) {
        window.location.replace('/')
    }
}

export {initThankYou}