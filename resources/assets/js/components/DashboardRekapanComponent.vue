	<template>
    <div class="table-responsive vertical">
        <table class="table table-bordered table-striped">
        	<thead>
            <tr>
	            <th>KODE</th>
	            <th>NAMA MARKETING</th>
	            <th>TOTAL</th>
	            <!-- will be for -->
	            <th v-for="tanggal_unique in tanggal_uniques.data">
	            	{{ tanggal_unique }}
	            </th>
            </tr>
        	</thead>
            <tbody>
            	<tr v-for="agent in agents.data">
                    <td> {{ agent.anggota_id }}</td>
                    <td> {{ agent.nama }}</td>
                    <td> {{ agent.total.total_result }}</td>
                    <td v-for="countRekapan in countRekapans.data" v-if="agent.anggota_id == countRekapan.anggota_id">{{ countRekapan.total == 0 ? '' : countRekapan.total }}</td>
            	</tr>
            	<tr>
            		<td colspan="2">GRAND TOTAL</td>
            		<td>{{ grand_total_by_between }}</td>
	            	<td v-for="tanggal_unique in tanggal_uniques.data">
	            		
	            	</td>
            	</tr>
            </tbody>
        </table>
    </div>
</template>
<script>
	export default {
		props: ['options', 'total', 'periode', 'tglawal', 'tglakhir'],
		mounted(){
			// console.log(this.periode);// JALAN
			this.getJadwalUnique();
			this.getAllAgents();
			this.countRekapan();
			// console.log(this.options); // JALAN
			// console.log(this.total) // JALAN
			this.grand_total_by_between = this.total; 
		},

		data(){
			return {
				grand_total_by_between: '',
				tanggal_uniques: [],
				agents: [],
				countRekapans: [],
				getTotalByParams: [],
				count: []
			}
		},

		methods: {
			getJadwalUnique(){
				axios.get('getJadwalUnique', { params: { requestPeriode: this.periode, requestStartDate: this.tglawal, requestEndDate: this.tglakhir } }).then(response => {
					this.tanggal_uniques = response.data;
				});
			},

			getAllAgents(){
				axios.get('getAllAgents', { params: { requestPeriode: this.periode, start: this.tglawal, end: this.tglakhir } }).then(response => {
					this.agents = response.data;
				});	
			},

			countRekapan(){
				axios.get('countRekapan',   { params: { requestPeriode: this.periode, requestStartDate: this.tglawal, requestEndDate: this.tglakhir } }).then(response => {
					this.countRekapans = response.data;
				})
			}
		}
	}
</script>