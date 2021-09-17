<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6 col-lg-4" v-for='img in allPhotos.slice(0,num)' :key='img.id' >
                <div class="card mb-3">
                    <div class="card-body text-center">
                        <img :src='img.url' :title='img.id' class="img-fluid">
                        <button @click="like(img.id);" v-if="img.fav" class="btn btn-light mt-3 like-active" :id="img.id" :name="img.fav">
                            <i class="fas fa-heart"></i> Like
                        </button>
                        <button @click="like(img.id);" v-else class="btn btn-light mt-3" :id="img.id" :name="img.fav">
                            <i class="fas fa-heart"></i> Like
                        </button>

                    </div>
                </div>
            </div>
        </div>
        <div class="row justify-content-center">
            <button @click="photoSort();" class="btn btn-primary mt-3"> Load more</button>
        </div>
    </div>
</template>

<script>
    export default {
        mounted() {
            this.getPhotosFunc();
            this.getUserFavorites();
            this.num = 10;
            this.resolveAfter1s();
        },
        data(){
            return{
                num: 0,
                photosArray:[],
                newPhoto:{
                    userId: '',
                    imageId: '',
                },
                photosFav:[],
                allPhotos:[],

            }
        },
        methods:{
            resolveAfter1s() {
                setTimeout(() => {
                    this.allPhotos = this.photosArray.map(el => {
                        if (this.photosFav.find(el2 => el.id === el2.imageId)) {
                            el.fav = true;
                        }else{
                            el.fav = false;
                        }                        
                        return el;
                    });
                }, 1000);
            },

            getPhotosFunc(){
                let self = this;
                axios.get('https://jsonplaceholder.typicode.com/photos')
                .then(function(response){
                    self.photosArray = response.data;
                });
            },

            getUserFavorites(){
                axios.get('/user_favorites').then((response)=>{
                    let favs = [];
                    for(let i=0; i<response.data.length;i++){
                        if(response.data[i].userId==this.$user){
                            favs.push(response.data[i]);
                        }
                    }
                    this.photosFav = favs;
                }).catch((error)=>{
                    console.log(error.message);
                });
            },

            photoSort(){
                this.num = this.num+10;
            },

            like(id){                
                this.newPhoto.userId=parseInt(this.$user);
                this.newPhoto.imageId=parseInt(id);
                let search = [];
                for(let i=0; i<this.photosFav.length;i++){
                    if(id === this.photosFav[i].imageId && this.$user == this.photosFav[i].userId){
                        search.push(1);
                        this.removePhotoFav();
                    }
                }
                if(search.length===0){
                    axios.post('/user_favorites', this.newPhoto);
                    this.getUserFavorites();
                }
                
                let boton = document.getElementById(id);
                boton.classList.toggle('like-active');
                this.newPhoto = {};
            },

            removePhotoFav(){
                let id;
                let user;
                let image;
                for(let i=0; i<this.photosFav.length;i++){
                    id = this.photosFav[i].id;
                    user = this.photosFav[i].userId;
                    image = this.photosFav[i].imageId;
                    if (user == this.newPhoto.userId && image == this.newPhoto.imageId){
                        axios.delete('/user_favorites/'+id).then((response)=>{
                            this.getUserFavorites();
                        }).catch((error)=>{
                            console.log(error.message);
                        })
                    }
                }
            },

        }
    }
</script>

