<template>
    <b-container class="mt-5 bg-light border p-2 rounded">
        <b-row>
            <div class="col-sm-6 mt-negative col-12 mb-5 mb-md-0">
                <div class="bg-info rounded  p-2 text-white text-center font-weight-bold">
                    SEPARANDO ({{pedSeparacao.length}})
                </div>
                <div v-if="pedSeparacao.length > 0" class="table-responsive vh-80 overflow-hidden">
                    <table class="table rounded-0 overflow-auto">
                        <thead>
                        <tr>
                            <th class="border-0">NRO. PEDIDO</th>
                            <th class="border-0">CLIENTE</th>
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
            </div>
            <div class="col-12 mt-negative col-sm-6 col-md-4 offset-0 offset-md-2">
                <div class="bg-success rounded p-2 text-white text-center font-weight-bold">
                    <i class="fas fa-people-carry"/> DISPONÍVEL NA EXPEDIÇÃO ({{pedExpedicao.length}})
                </div>
                <div v-if="pedExpedicao.length > 0" class="overflow-hidden vh-80">
                    <info-cards v-for="(item,idx) in pedExpedicao.slice(0,4)" :key="idx" :item="item"/>
                </div>
                <h4 class="text-center p-2 text-black-50" v-else>Sem produtos</h4>
            </div>
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
                        setTimeout(() => {
                            this.getPedidos();
                        }, 5000);
                    }).catch(err => {
                    console.log(err)
                });
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

    .mt-negative {
        margin-top: -1.5rem !important;
    }
</style>
