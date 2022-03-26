
/**
 * This file is not being used right now
 * I will be replacing the vue script with a raw php output for the detailled listing page
 */
var ListingSummary = new Vue({
    el:'#listing-summary',
    data: {
        price: "",
        bedrooms: "",
        bathrooms: "",
        area: "",
        lotSize: "",
        street: "",
        city: "",
        state: "",
        zip: ""
    },
    methods: {
        getListing: function(){
            axois.get('PHPScripts/getListingSummary.php')
            .then( function (listing_results) {
                ListingSummary = listing_results.data; //This might not work... setting the whole app equal to the data returned
            })
            .catch(function (error) {
                console.log(error);
            });
        }
    },
    created: function(){
        this.getListing();
    }
})