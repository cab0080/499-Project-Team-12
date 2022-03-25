var PhotoContainer = new Vue({
    el: '#photo-container',
    data: {
        photos: []
    },
    methods: {
        getPhotos: function(){
            axios.get('PHPScripts/getListingPhotos.php')
            .then( function (photo_results) {
                PhotoContainer.photos = photo_results.data;
                //console.log(photo_results.data);
            })
            .catch(function (error) {
                console.log(error);
            });
        }
    },

    created: function(){
        this.getPhotos();
    }
})