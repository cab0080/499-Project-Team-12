var app = new Vue({
    el: '#listing-container',
    data: {
      mls: "",
      street: "",
      price: "",
      listings: []
    },
    methods: {
      filterRecords: function(){
        const params = new URLSearchParams(window.location.search);
        axios.get('PHPScripts/fetchListings.php', { params })
        .then(function (listing_results) {
          app.listings = listing_results.data;
        })
        .catch(function (error) {
          console.log(error);
        });
      }
    },
    created: function(){
      this.filterRecords();
    },
    filters: {
      usPrice: function (value) {
        return "$" + parseInt(value).toLocaleString("en-US");
      },
      usInteger: function(value) {
        return parseInt(value).toLocaleString("en-US");
      }
    },
  })