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
        for (const [key, value] of params) {
          type = $("input[name=" + key + "]").attr("type")
          if (type == "number" || type == "text") {
            $("input[name=" + key + "]").attr("value", value);
          } else if (type == "checkbox" && value == "on") {
            $("input[name=" + key + "]").attr("checked", "checked");
          }
        }
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