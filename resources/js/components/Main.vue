<template>
    <b-container class="mt-5">
        <b-row class="vh-80">
            <b-card class="h-100 col-sm-6 col-12">
                <div class="bg-info rounded mt-negative p-2 text-white text-center font-weight-bold">
                    SEPARANDO ({{pedSeparacao.length}})
                </div>
                <div v-if="pedSeparacao.length > 0" class="table-responsive overflow-hidden h-100">
                    <table class="table overflow-auto">
                        <thead>
                        <tr>
                            <th>NRO. PEDIDO</th>
                            <th>CLIENTE</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr v-for="item in  pedSeparacao" :key="item.numped">
                            <td> {{item.numped}}</td>
                            <td>{{item.cliente}}</td>
                        </tr>
                        </tbody>
                    </table>
                </div>
                <h4 class="text-center p-2 text-black-50" v-else>Sem produtos</h4>
            </b-card>
            <b-col cols="12" sm="4" offset-sm="2" class="h-100">
                <b-card class="h-100">
                    <div class="bg-success rounded mt-negative p-2 text-white text-center font-weight-bold">
                        <i class="fas fa-people-carry"/> DISPONÍVEL NA EXPEDIÇÃO ({{pedExpedicao.length}})
                    </div>
                    <div v-if="pedExpedicao.length > 0" class="overflow-hidden h-100">
                        <info-cards v-for="(item,idx) in pedExpedicao" :key="idx" :item="item"/>
                    </div>
                    <h4 class="text-center p-2 text-black-50" v-else>Sem produtos</h4>
                </b-card>
            </b-col>
        </b-row>
    </b-container>
</template>
<script>
    import InfoCards from './InfoCards.vue'
    import NavBar from './NavBar.vue'

    export default {
        components: {InfoCards, NavBar},
        data() {
            return {
                pedExpedicao: [],
                pedSeparacao: [],
            }
        },
        mounted() {

            // this.getPedidosEmExpedicao();
            // this.getPedidosEmSeparacao();
            this.getPedidos();
        },
        methods: {
            getPedidos() {

                axios.get('/separacao-expedicao')
                    .then(({data}) => {
                        this.pedExpedicao = data.expedicao;
                        this.pedSeparacao = data.separacao;
                    }).catch(err => {
                    console.log(err)
                });

                setTimeout(() => {
                    this.getPedidos();
                }, 5000);
            },
            getPedidosEmExpedicao() {

                axios.get('/expedicao')
                    .then(({data}) => {
                        this.pedExpedicao = data;
                    }).catch(err => {
                    console.log(err)
                });

                setTimeout(() => {
                    this.getPedidosEmExpedicao();
                }, 5000);
            },
            getPedidosEmSeparacao() {
                axios.get('/separacao')
                    .then(res => {
                        this.pedSeparacao = res.data;
                    }).catch(err => {
                    console.log(err)
                })
            }

        },
    }
</script>
<style scoped>
    .vh-80 {
        height: 80vh;
    }

    .overflow-hidden {
        overflow-y: hidden;
    }

    .mt-negative {
        margin-top: -2rem !important;
    }
</style>
