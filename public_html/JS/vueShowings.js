var Showings = new Vue({
    el: '#showing-list',
    data: {
        showings: []
    },
    methods: {
        getShowings: function(){
            axios.get('PHPScripts/fetchShowings.php')
            .then( function (showings_results) {
                Showings.showings = showings_results.data;
            })
            .catch( function (error) {
                console.log(error);
            })
        }
    },

    created: function(){
        this.getShowings();
    }
})