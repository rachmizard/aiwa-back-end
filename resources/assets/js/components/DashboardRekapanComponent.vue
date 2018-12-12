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
                    <td> {{ agent.anggota.nama }}</td>
                    <td> {{ agent.total }}</td>
                    <td v-for="countRekapan in countRekapans.data" v-if="agent.anggota_id == countRekapan.anggota_id">{{ countRekapan.total == 0 ? '' : countRekapan.total }}</td>
            	</tr>
            </tbody>
        </table>
    </div>
</template>
<script>
	export default {
		props: ['periode', 'tglawal', 'tglakhir'],
		mounted(){
			console.log(this.periode);
			this.getJadwalUnique();
			this.getAllAgents();
			this.countRekapan();
		},

		data(){
			return {
				tanggal_uniques: [],
				agents: [],
				countRekapans: [],
				getTotalByParams: []
			}
		},

		methods: {
			getJadwalUnique(){
				axios.get('getJadwalUnique', { params: { requestPeriode: this.periode, requestStartDate: this.tglawal, requestEndDate: this.tglakhir } }).then(response => {
					this.tanggal_uniques = response.data;
				});
			},

			getAllAgents(){
				axios.get('getAllAgents', { params: { requestPeriode: this.periode, requestStartDate: this.tglawal, requestEndDate: this.tglakhir } }).then(response => {
					this.agents = response.data;
				});	
			},

			countRekapan(){
				axios.get('countRekapan',   { params: { requestPeriode: this.periode, requestStartDate: this.tglawal, requestEndDate: this.tglakhir } }).then(response => {
					this.countRekapans = response.data;
				})
			},

			getAnggotaId(var1, var2){
				axios.get('getTotalByParams', { params: { anggota_id: var1, tgl_berangkat: var2 } }).then(response => {
					return console.log(response.data);
				})
			}
		}
	}
</script>