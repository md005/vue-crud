<template>
    <div class="container">
        <div class="row mt-5">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header text-center">
                        <h2 class="text-success" v-show="elementVisible">{{successMessage}}</h2>
                        <h1 class="text-secondary">{{titleMessage}}</h1>
                        <router-link :to="{name:'AddNew'}" class="btn btn-sm btn-secondary">Add new</router-link>
                    </div>
                    <div class="card-body">
                        <table class="table text-center">
                            <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Product Name</th>
                                <th scope="col">Product Price</th>
                                <th scope="col">Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr v-for="(product, index) in products" key="product.id">
                                <th scope="row">{{++index}}</th>
                                <td>{{product.product_name}}</td>
                                <td>{{product.product_price}}</td>
                                <td>
                                    <router-link :to="{name: 'Edit', params: {id: product.id}}" class="btn btn-sm btn-primary">Edit</router-link>
                                    &nbsp;
                                    <a @click.prevent="destroy(product.id)" class="btn btn-sm btn-danger">Delete</a>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default{
        data(){
            return{
                products: [],
                titleMessage:'',
                elementVisible: true,
                successMessage:''
            }
        },
        mounted(){
           this.getProductList();
        },
        methods:{
            getProductList(){
                axios.get('/api/product')
                    .then((success)=>{
                        //console.log(success.data.products);
                        this.products = success.data.products;
                        this.titleMessage = success.data.message;
                    }).catch((errors)=>{
                    console.log(errors);
                });
            },
            destroy(product_id){
                axios.delete('/api/product/'+product_id)
                    .then((success)=>{
                        //console.log(success.data.products);
                        this.getProductList();
                        this.successMessage = success.data.message;
                        setTimeout(() => this.elementVisible = false, 3000);

                    }).catch((errors)=>{
                    console.log(errors);
                });
            }
        }
    };
</script>

<style></style>