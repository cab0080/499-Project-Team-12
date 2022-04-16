/**
 * This script is currently not being used
 */

var SoldListings = new Vue({
    el: '#sold-listing-list',
    data: {
        soldListings: []
    },
    methods: {
        getSoldListings: function(){
            axios.get('PHPScripts/fetchSoldListings.php')
            .then( function (sold_listings_results) {
                SoldListings.soldListings = sold_listings_results.data;
            })
            .catch( function (error) {
                console.log(error);
            })
        }
    },

    created: function(){
        this.getSoldListings();
    }
})