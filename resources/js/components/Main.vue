<template>
    <b-container class="mt-5">
        <b-row>
            <b-col cols="6">
                <b-card>
                 <loading :active.sync="isLoading"
                    :can-cancel="false"
                    loader='bars'
                    :is-full-page="fullPage"></loading>
                <div class="bg-info rounded mt-negative p-2 mb-2 text-white text-center font-weight-bold">
                    SEPARANDO
                </div>
                <table class="table">
                    <thead>
                        <th>Nro. Pedido</th>
                        <th>Cliente</th>
                    </thead>
                    <tbody>
                        <tr v-for="(item, index) in pedExpedicao">
                            <td> {{item.numped}}</td>
                            <td>{{item.cliente}}</td>
                        </tr>
                    </tbody>
                </table>
                </b-card>
            </b-col>
             <b-col cols="6">
                <b-card>
                <div class="bg-success rounded mt-negative p-2 mb-2 text-white text-center font-weight-bold">
                    DISPONÍVEL NA EXPEDIÇÃO
                </div>

                    <div v-for="(item, index) in pedExpedicao">
                        <infocards :item="item"></infocards>
                    </div>
                </b-card>
            </b-col>
        </b-row>
    </b-container>
</template>
<script>
import InfoCards from './InfoCards.vue'
import NavBar from './NavBar.vue'
import Loading from 'vue-loading-overlay';
// Import stylesheet
import 'vue-loading-overlay/dist/vue-loading.css';
export default {
    components: {
        'infocards': InfoCards,
        'loading' : Loading,
        'nav-bar': NavBar
    },
    data() {
        return {
            pedExpedicao: [
                {
                    numped: '55555',
                    cliente: 'Daniel de Sá '
                },
                {
                    numped: '5645656',
                    cliente: 'David Felipe Souza '
                }
            ],
            pedSeparacao: [{}],
            fullPage: false,
            isLoading: true
        }
    },
    mounted() {
        setTimeout(() => {
                  this.isLoading = false
        },5000)
        //this.getPedidosEmExpedicao()
        this.getPedidosEmSeparacao()
        console.log();
    },
    methods: {
        getPedidosEmExpedicao() {
             axios.get('/expedicao/loja/1')
                .then(res => {
                    this.pedExpedicao = res.data;
                    commit('FETCH_POSTS', res.data)
                }).catch(err => {
                console.log(err)
            })
        },
        getPedidosEmSeparacao() {
             axios.get('/separacao/loja/1')
                .then(res => {
                    this.pedSeparacao = res.data;
                    commit('FETCH_POSTS', res.data)
                }).catch(err => {
                console.log(err)
            })
        }

    },
}
</script>
<style scoped>
    .mt-negative{
        margin-top: -2rem !important;
    }
</style>
