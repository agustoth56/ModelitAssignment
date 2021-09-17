<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6 col-lg-4" v-for="photo in userFavs" :key="photo.id">
                <div class="card mb-3" v-for='img in photosArray.slice(photo.imageId-1,photo.imageId)' :key='img.id'>
                    <div class="card-body text-center">
                        <img :src='img.url' :title="img.id" class="img-fluid">
                        <button @click="removeUserFavorites(photo.id);" class="btn btn-light mt-3 like-active" :id="photo.id"><i class="fas fa-heart"></i> Like</button>
                    </div>
                    
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        mounted() {
            this.getUserFavorites();
            this.getPhotosFunc();

        },
        data(){
            return{
                userFavs:[],
                photosArray:[],
            }
        },
        methods:{
            getUserFavorites(){
                axios.get('/user_favorites').then((response)=>{
                    let favs = [];
                    for(let i=0; i<response.data.length;i++){
                        
                        if(response.data[i].userId==this.$user){
                            let img = response.data[i].imageId
                            favs.push(response.data[i]);
                        }

                    }
                    this.userFavs = favs;
                }).catch((error)=>{
                    console.log(error.message);
                })
            },
            removeUserFavorites(id){
                axios.delete('/user_favorites/'+id).then((response)=>{
                    this.getUserFavorites();
                }).catch((error)=>{
                    console.log(error.message);
                })
            },      
            getPhotosFunc(){
                let self = this;
                axios.get('https://jsonplaceholder.typicode.com/photos')
                .then(function(response){
                    self.photosArray = response.data;

                });
            },
        }
    }
</script>