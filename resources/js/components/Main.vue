<template>
    <div>
        <nav-bar/>
        <b-container class="mt-4 bg-light border pt-1 pb-1" fluid="">
            <b-row>
                <div id='card_sep' class="col-sm-6 mt-negative col-12 mb-5 mb-md-0">
                    <div class="bg-info rounded  p-2 text-white text-center font-weight-bold">
                        SEPARANDO ({{pedSeparacao.length}})
                    </div>
                    <div  class="table-responsive  mt-1 vh-65 overflow-hidden">
                        <table v-if="pedSeparacao.length > 0" class="table    overflow-auto">
                            <thead>
                            <tr class="text-black-50">
                                <th class="border-0"># PEDIDO</th>
                                <th class="border-0"><i class="fa fa-user"/> CLIENTE</th>
                                <th class="border-0" style="width: 120px"><i class="far fa-clock"/>  TEMPO</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr v-for="(item, index) in  pedSeparacao.slice(0,8)" :key="index">
                                <td> {{item.numped}}</td>
                                <td>{{item.cliente | nomeCliente}}</td>
                                <td class="text-center">
                                    <span :class="item.cliente | classItem"><i class="far fa-clock"/> {{item.cliente | time}} min</span>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                        <h4 class="text-center p-2 text-black-50" v-else>Sem pedidos</h4>
                    </div>
                </div>
                <div id='card_disp' class="col-12 mt-negative col-sm-6">
                    <div class="bg-success rounded p-2 text-white text-center font-weight-bold">
                        <i class="fas fa-people-carry"/> DISPONÍVEL NA EXPEDIÇÃO ({{pedExpedicao.length}})
                    </div>
                    <div  class="overflow-hidden vh-65">
                        <info-cards v-if="pedExpedicao.length > 0" v-for="(item,idx) in pedExpedicao.slice(0,4)" :key="idx" :item="item"/>
                    </div>
                </div>
            </b-row>
        </b-container>
        <footer id="sticky-footer" class="vh-10 text-center container pt-2 text-black-50">
            <small>&copy; 2020 CAA - Comércio Amazonense de Alumínio </small>
            <img height="40px" src="/images/logo01.png">
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
            var url_atual = window.location.href;
            //console.log(url_atual);
            let array = url_atual.split('loja/');
            //console.log(array);
            //let filtro = array.filter(valor => valor.includes('/'))
            //console.log(filtro);
        },
        methods: {
            getPedidos() {
                let params = (window?.location?.href ?? document?.URL).split('?').pop();
                let loja =  new URLSearchParams(params).get('loja') ?? '1';
                axios.get(`/pedidos/loja/${loja}`)
                .then(({data}) => {
                    this.pedExpedicao = data.data['expedicao'];
                    this.pedSeparacao =  data.data['separacao'];
                }).catch(err => {

                });
                setTimeout(() => {
                    this.getPedidos();
                }, 5000);

            }

        },
        filters: {
            classItem(nome){
                let time = nome.split(':');
                time = time.pop().trim();
                return parseInt(time) && +time >= 10 ? 'badge badge-danger' : 'badge badge-info';
            },
            nomeCliente(nome){
                let novoNome = nome.split('-');
                novoNome.pop();
                return novoNome.join('-');
            },
            time(nome){
                let time = nome.split(':');
                return time.pop().trim();
            }
        }
    }
</script>
<style scoped>
    .vh-65 {
        height: 65vh;
    }

    .vh-10 {
        height: 10vh;
    }

    .mt-negative {
        margin-top: -1.5rem !important;
    }
</style>
