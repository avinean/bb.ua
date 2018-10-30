export default {
    methods: {
        async request(j) {
            let params;
            if (j['method'] === 'get') {
                params = {params: j}
				return await this.axios('/api/request', params)
            }
            if (j['method'] === 'post') {
				params = new URLSearchParams()
				for (let key in j) {
					params.append(key, j[key])
				}
				return await this.axios.post('/api/request', params)
            }
        },
        async admin(methodName, opts) {
			let params = new URLSearchParams();
			params.append('opts', JSON.stringify(opts));
			params.append('methodName', methodName);
			return await this.axios.post('/secure/admin', params)
        },
		isValidEmail(email) {
			return /^([a-z0-9_-]+\.)*[a-z0-9_-]+@[a-z0-9_-]+(\.[a-z0-9_-]+)*\.[a-z]{2,6}$/.test(email);
		},
		isValidPhone(phone) {
			return /^((8|\+38|38)[\- ]?)?(\(?\d{3}\)?[\- ]?)?[\d\- ]{10,10}$/.test(phone);
		},
		async loadFile(e) {
			let file = e.target.files[0];
			let form = new FormData;
			form.append('file', file);
			let res = await this.axios.post(
				'/secure/uploadFile',
				form,
				{headers: {'Content-Type': 'multipart/form-data'}}
			);
			return res.data;
		},
		writeVisitStat(val) {
			this.request({
				method: 'get',
				className: 'Stat',
				methodName: 'writeVisitStat',
				opts: {
					fullPath: val.fullPath,
					path: val.path,
					page: val.path.split('/')[1],
					category: val.params.category || 'none',
					id: val.params.id || 'none',
				}
			});
		},
		writeContactStat(opts) {
			this.request({
				method: 'get',
				className: 'Stat',
				methodName: 'writeContactStat',
				opts
			});
		}
    }
}