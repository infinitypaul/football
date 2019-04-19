<template>
    <div class="row justify-content-center">
        <div v-if="response.league.data.length" class="col-md-12 py-4"  v-for="leagues, week in filteredRecords" >
            <div class="card">
                <div class="card-header">
                    League Table Week {{ week }}
                    <span class="float-right">
                        Match Result
                    </span>
                </div>

                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-6 tags p-b-2">
                            <table class="table">
                                <thead>
                                <tr>
                                    <th scope="col">Teams</th>
                                    <th scope="col">PTS</th>
                                    <th scope="col">P</th>
                                    <th scope="col">W</th>
                                    <th scope="col">D</th>
                                    <th scope="col">L</th>
                                    <th scope="col">GD</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr v-for="item in leagues">
                                    <th scope="row">{{ item.team.data.title}}</th>
                                    <td>{{item.pts }}</td>
                                    <td>{{ item.p}}</td>
                                    <td>{{ item.w}}</td>
                                    <td>{{item.d}}</td>
                                    <td>{{item.l}}</td>
                                    <td>{{item.gd}}</td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="col-lg-5 offset-lg-1">
                            <ul class="list-group">
                                <span class="mt-4" v-for="games in filteredGames[week]">
                                <li class="list-group-item list-group-item-primary">

                                        Referee: {{ games.ref }}
                                </li>
                                <li class="list-group-item d-flex justify-content-between align-items-center" >
                                    {{ games.home.data.title}}
                                    <span class="badge badge-primary badge-pill">{{ games.home_goal}}</span>
                                    -
                                    <span class="badge badge-primary badge-pill">{{ games.away_goal}}</span>
                                    {{ games.away.data.title}}
                                    <span class="vr">&nbsp;</span>
                                    <div class="float-right">
                                    <small>{{ games.date_played }}</small>
                                    </div>
                                </li>
                                </span>

                            </ul>
                        </div>
                    </div>
                </div>
                <div class="card-footer text-muted">
                    <a v-if="Object.keys(filteredRecords).length == week && week != 6" class="float-left" id="playall" href="#" @click.prevent="moveToNextWeek(+week + +1)">
                        Play All
                    </a>
                    <span v-if="!loading">
                        <a v-if="Object.keys(filteredRecords).length == week && week != 6" class="float-right" id="new_week" href="#" @click.prevent="moveToNextWeek(+week + +1)">
                            Next Week
                        </a>
                    </span>
                    <span class="float-right" v-else>
                        Loading
                    </span>
                </div>
            </div>
        </div>
        <div class="col-md-8 py-4" v-if="!response.league.data.length ">
            <ul class="list-group">
               <span class="mt-4" v-for="games in filteredGames[1]">
                                <li class="list-group-item list-group-item-primary">

                                        Referee: {{ games.ref }}
                                </li>
                                <li class="list-group-item d-flex justify-content-between align-items-center" >
                                    {{ games.home.data.title}}
                                    <span class="badge badge-primary badge-pill">{{ games.home_goal}}</span>
                                    -
                                    <span class="badge badge-primary badge-pill">{{ games.away_goal}}</span>
                                    {{ games.away.data.title}}
                                    <span class="vr">&nbsp;</span>
                                    <div class="float-right">
                                    <small>{{ games.date_played }}</small>
                                    </div>
                                </li>
                </span>
                <span v-if="!loading">
                <a href="#" v-if="id !== ''" @click.prevent="moveToNextWeek(1)" class="btn btn-info float-right mt-2">
                    Play First Match
                </a>
                    </span>
                <span v-else>
                    Loading....
                </span>
            </ul>

        </div>

    </div>
</template>

<script>
    export default {
        props:['id'],
        name: "LeagueTable",
        data(){
            return {
                loading:false,
                response:{
                    league : {
                        'data': []
                    },
                    game: []
                }
            }
        },
        computed:{
            filteredRecords(){
                let data = this.response.league.data;
                const result = {};
                if(this.response.league.data) {
                    data.filter(item => {
                        if (!result[item['week']]) {
                            result[item['week']] = []
                        }
                        result[item['week']].push(item)
                    });

                }
                return result
            },
            filteredGames(){
                let data = this.response.game.data;
                const result = {};
                if(this.response.game.data) {
                    data.filter(item => {
                        if (!result[item['week']]) {
                            result[item['week']] = []
                        }
                        result[item['week']].push(item)
                    });
                }
                return result
            }
        },
        methods:{
            getRecords(){
                this.loading = true;
                if(this.id){
                    return axios.get('/getseason/'+this.id)
                        .then((response)=>{
                            this.response = response.data.data;
                            console.log(response);
                            this.loading = false;
                        })
                        .catch((err)=>{
                            console.log(err);
                            this.loading = false;
                        })
                }
            },
            moveToNextWeek(week){
                this.loading = true;
                axios.post('/nextmove/'+this.id, {'week':week})
                    .then((response)=>{
                        this.getRecords();
                        this.loading = false;
                    })
                    .catch((err)=>{
                        console.log(err)
                        this.loading = false;
                    })
            },
            getSize(obj){
                    var size = 0, key;
                    for (key in obj) {
                        if (obj.hasOwnProperty(key)) size++;
                    }
                    return size;
            }
        },
        mounted() {
            this.getRecords()
        }
    }
</script>

<style scoped>
    .vr {
        width:1px;
        background-color:#000;
        top:0;
        bottom:0;

    }
</style>
