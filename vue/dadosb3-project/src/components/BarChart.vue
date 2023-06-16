<template>
    <div>
        <div class="header">
            <select v-model="selected" @change="onChange">
                <option v-for="option in options_select" :key="option.value" :value="option.value">
                    {{ option.text }}
                </option>
            </select>
            <div><span>Filtro selecionado:</span> {{ selected }}</div>
        </div>
        <Bar :data="data" :options="options" />

        <pagination-chart v-if="lendings.length" :offset="offset" :total="total" :limit="limit" @change-page="changePage" />
    </div>
</template>

<script>
import PaginationChart from '@/components/PaginationChart.vue';
import {
    Chart as ChartJS,
    Title,
    Tooltip,
    Legend,
    BarElement,
    CategoryScale,
    LinearScale,
} from 'chart.js'
import { Bar } from 'vue-chartjs'
import axios from 'axios'

ChartJS.register(CategoryScale, LinearScale, BarElement, Title, Tooltip, Legend);

export default {
    name: "App",
    components: {
        Bar,
        PaginationChart
    },
    data() {
        return {
            selected: '',
            options_select: [{ text: 'Todos', value: '', id: '' }],
            lendings: [1],
            offset: 0,
            total: 0,
            limit: 16,
            ativo: null,
            data: {
                labels: 'labels',
                datasets: [{}],
            },
            options: {
                scales: {
                    x: {
                        grid: { offset: false }
                    }
                }
            }
        }
    },
    methods: {
        onChange() {
            if (this.selected == '') {
                this.limit = 16;
            } else {
                this.limit = 1;
                this.lendings.length = 1;
            }
            
            this.getLending();
        },
        mountChart(response) {
            this.chart = response.data;
            
            let labelsAux = [];
            for (let i = 0; i < this.limit; i++) {
                labelsAux.push(this.chart[i]["columns"]);
            }
            
            let valuesAux = [];
            for (let i = 0; i < this.limit; i++) {
                valuesAux.push(this.chart[i]["value"]);
                this.options_select.push({ text: this.chart[i]["columns"], value: this.chart[i]["columns"], id: this.chart[i]["columns"] });
            }
            
            this.data = {
                labels: labelsAux,
                datasets: [{
                    label: 'Preço Médio',
                    data: valuesAux,
                    backgroundColor: ['#BBFF33'],
                    borderColor: ['#49479D'],
                    borderWidth: 1,
                    barThickness: 15,
                }]
            };
            
            this.options = {
                indexAxis: 'y',
                scales: {
                    x: { stacked: true },
                    y: { stacked: true }
                }
            }
        },
        changePage(value) {
            this.offset = value;
            this.getLending();
        },
        getLending() {
            const BASE_URL = 'http://localhost:8000/api';
            const url = `${BASE_URL}/leding/chart?page=${this.offset}&size=${this.limit}&ativo=${this.selected}`;
           
            axios.get(url).then((data) => {
                this.ledings = data.data;
                this.total = data.data.totalledings;
                this.mountChart(data);
            }).catch((error) => {
                console.log("Error: ", error);
            });
        },
        
    },
    created() {
        this.getLending();
    },
}

</script>

<style scope>
.header {
    display: flex;
    justify-content: center;
    align-items: center;
    flex-direction: column;
    margin: 10px;
}
.header select {
    width: 100px;
    height: 30px;
    border-radius: 5px;
    border: 2px solid #49479D;
    padding: 5px;
    margin: 5px;
    cursor: pointer;
}
.header span {
    margin: 5px;
    display: flex;
    justify-content: start;
    background-color: #49479DBB;
    border-radius: 5px;
    padding: 5px;
    color: #FFFFFF;
}
</style>
```