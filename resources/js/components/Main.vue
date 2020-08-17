<template>
    <div>
        <nav-bar/>
        <b-container class="mt-4 bg-light border p-2 rounded">
            <b-row>
                <div class="col-sm-6 mt-negative col-12 mb-5 mb-md-0">
                    <div class="bg-info rounded  p-2 text-white text-center font-weight-bold">
                        SEPARANDO ({{pedSeparacao.length}})
                    </div>
                    <div v-if="pedSeparacao.length > 0" class="table-responsive  mt-1 vh-75 overflow-hidden">
                        <table class="table   overflow-auto">
                            <thead>
                            <tr class="text-black-50">
                                <th class="border-0"># NRO. PEDIDO</th>
                                <th class="border-0"><i class="fa fa-user"/> CLIENTE</th>
                                <th class="border-0" style="width: 120px"><i class="far fa-clock"/> TEMPO</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr v-for="item in  pedSeparacao.slice(0,8)" :key="item.numped">
                                <td> {{item.numped}}</td>
                                <td>{{item.cliente}}</td>
                                <td class="text-center"><span v-if="item.time" class="badge badge-info">{{item.time | time}} min</span>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                    <h4 class="text-center p-2 text-black-50" v-else>Sem produtos</h4>
                </div>
                <div class="col-12 mt-negative col-sm-6 col-md-4 offset-0 offset-md-2">
                    <div class="bg-success rounded p-2 text-white text-center font-weight-bold">
                        <i class="fas fa-people-carry"/> DISPONÍVEL NA EXPEDIÇÃO ({{pedExpedicao.length}})
                    </div>
                    <div v-if="pedExpedicao.length > 0" class="overflow-hidden vh-75">
                        <info-cards v-for="(item,idx) in pedExpedicao.slice(0,4)" :key="idx" :item="item"/>
                    </div>
                    <h4 class="text-center p-2 text-black-50" v-else>Sem produtos</h4>
                </div>
            </b-row>
        </b-container>
        <footer id="sticky-footer" class="py-4 bg-dark text-white-50">
            <div class="container text-right">
                <small>&copy; 2020 CAA - Comércio Amazonense de Alumínio </small>
                <img height="40px" src="/images/logo01.png">
            </div>
        </footer>
    </div>
</template>
<script>
    import InfoCards from './InfoCards.vue'
    import NavBar from './NavBar.vue'

    const moment = require('moment');

    export default {
        components: {InfoCards, NavBar},
        data() {
            return {
                pedSeparacao: [],
                pedExpedicao: [],
                timePedidos: []
            }
        },
        mounted() {
            this.getPedidos();
        },
        methods: {
            getPedidos() {
                axios.get('/separacao-expedicao')
                    .then(({data}) => {
                        this.pedExpedicao = data['expedicao'];
                        const pedidos = data['separacao'].filter(pedido => this.pedSeparacao.every(p => pedido.numped !== p.numped));
                        this.pedSeparacao.push(...pedidos.map(pedido => {
                            pedido.time = moment();
                            return pedido;
                        }));
                    }).catch(err => {
                    console.log(err)
                });
                setTimeout(() => {
                    this.getPedidos();
                }, 5000);
            }

        },
        filters: {
            time(startTime) {
                let duration = moment.duration(moment(new Date()).diff(startTime));
                return parseFloat(duration.asMinutes()).toFixed(0);
            }
        }
    }
</script>
<style scoped>
    .vh-75 {
        height: 75vh;
    }

    .mt-negative {
        margin-top: -1.5rem !important;
    }
</style>
