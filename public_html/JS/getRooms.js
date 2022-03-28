var RoomsContainer = new Vue({
    el: '#room-list',
    data: {
        rooms: []
    },
    methods: {
        getRooms: function(){
            axios.get('PHPScripts/getRoomList.php')
            .then( function (room_results) {
                RoomsContainer.rooms = room_results.data;
            })
            .catch(function (error) {
                console.log(error);
            })
        }
    },

    created: function(){
        this.getRooms();
    }
})