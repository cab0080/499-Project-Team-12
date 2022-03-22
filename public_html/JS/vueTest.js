var app = new Vue({
    el: '#myapp',
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
    }
  })