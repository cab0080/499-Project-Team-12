var app = new Vue({
    el: '#listing-container',
    data: {
      mls: "",
      street: "",
      price: "",
      listings: []
    },
    methods: {
      allRecords: function(){
        axios.get('PHPScripts/fetchListings.php')
        .then(function (listing_results) {
          app.listings = listing_results.data;
        })
        .catch(function (error) {
          console.log(error);
        });
      }
    },
    created: function(){
      this.allRecords();
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