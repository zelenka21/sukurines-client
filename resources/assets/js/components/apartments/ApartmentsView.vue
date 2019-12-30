<template>
    <div>
        <div class="form-group">
            <router-link to="/" class="btn btn-default">Back</router-link>
        </div>
        <div class="panel panel-default">
            <div class="panel-heading">Apartment information</div>
            <div class="panel-body">
                
                <table class="table table-bordered table-striped">
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th>Title</th>
                        <th>Description</th>
                        <th>Address</th>

                    </tr>
                    </thead>
                    <tbody>
                  <tr >
                        <td>{{ apartments.id  }}</td>
                        <td>{{ apartments.title }}</td>
                        <td>{{ apartments.description }}</td>
                        <td>{{ apartments.location }}</td>
                    
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="panel panel-default">
         <div class="panel-heading">Apartment Reviews</div>
            <div class="panel-body">
                
                <table class="table table-bordered table-striped">
                    <thead>
                    <tr>
                        <th>title</th>
                        <th>reviewText</th>
                        <th>rating</th>
                    </tr>
                    </thead>
                    <tbody>
                     <tr v-for="res, index in reviews">
                        <td>{{ res.title  }}</td>
                        <td>{{ res.reviewText }}</td>
                        <td>{{ res.rating }}</td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
        </div>
        </div>
</template>

<script>
    export default {
         data: function () {
            return {
                apartments: [],
                reviews: []
            }
        },
        mounted() {
            let app = this;

            let id = app.$route.params.id;

            axios.get(process.env.MIX_API_URL+'api/apartments/'+ id)
                .then(function (resp) {
                    app.apartments = resp.data.data;
                })
                .catch(function (resp) {
                    console.log(resp);
                    alert("Could not load apartments");
                });


            axios.get(process.env.MIX_API_URL+'api/apartments/'+ id + '/reviews/')
                .then(function (resp) {
                    app.reviews = resp.data.data;
                    console.log(app.reviews);
                })
                .catch(function (resp) {
                    console.log(resp);
                    alert("Could not load reviews");
                });

        },

        
        
    }
</script>
