<template>
    <div>

        <div class="d-flex align-items-end flex-wrap">

            <!-- Filters -->
            <template v-for="f in filters" :key="f.model">
                <div class="d-flex gap-1 flex-column me-2 mb-2">

                    <!-- Label -->
                    <label class="mb-1 small">{{ f.label }}</label>
                    <div v-if="f.type === 'select'">

                        <!-- Select -->
                        <select v-model="filterValues[f.model]" class="form-select" @change="fetchData">
                            <option v-for="opt in f.options" :key="opt.value" :value="opt.value">
                                {{ opt.label }}
                            </option>
                        </select>
                    </div>

                    <!-- Date -->
                    <input v-else-if="f.type === 'date'" type="date" v-model="filterValues[f.model]"
                        class="form-control ml-1" @change="fetchData" />

                    <!-- Text -->
                    <input v-else-if="f.type === 'text'" v-model="filterValues[f.model]" class="form-control ml-1"
                        @input="fetchData" />

                </div>
            </template>

            <!-- Search (RIGHT SIDE) -->
            <div class="ms-auto ml-auto mb-2">
                <input v-model="searchInput" placeholder="Search..." class="form-control" />
            </div>

        </div>

        <!-- 📊 Table -->
        <div class="table-responsive position-relative">

            <!-- 🔄 Loader -->
            <div v-if="loading" class="text-center py-4">
                <div class="spinner-border"></div>
            </div>

            <table v-else class="table table-bordered align-middle">
                <thead class="table-light">
                    <tr>
                        <th v-for="col in columns" :key="col.field" @click="col.sortable !== false && sort(col.field)"
                            style="cursor:pointer">
                            {{ col.label }}

                            <span v-if="sortField === col.field">
                                {{ sortDirection === 'asc' ? '▲' : '▼' }}
                            </span>
                        </th>

                        <!-- Actions Column -->
                        <th v-if="$slots.actions">Actions</th>
                    </tr>
                </thead>

                <tbody>
                    <tr v-if="!rows.length">
                        <td :colspan="columns.length + ($slots.actions ? 1 : 0)" class="text-center">
                            No data
                        </td>
                    </tr>

                    <tr v-for="row in rows" :key="row.id">

                        <td v-for="col in columns" :key="col.field">

                            <!-- Badge -->
                            <span v-if="col.type === 'badge'" class="badge"
                                :class="badgeClass(getValue(row, col.field))">
                                {{ getValue(row, col.field) }}
                            </span>

                            <!-- Custom Render -->
                            <span v-else-if="col.render" v-html="col.render(row)">

                            </span>

                            <!-- Default -->
                            <span v-else>
                                {{ getValue(row, col.field) }}
                            </span>

                        </td>

                        <!-- Actions Slot -->
                        <td v-if="$slots.actions">
                            <slot name="actions" :row="row"></slot>
                        </td>

                    </tr>
                </tbody>
            </table>
        </div>

        <!-- 📄 Pagination -->
        <nav v-if="meta.last_page > 1">
            <ul class="pagination justify-content-center">

                <!-- Prev -->
                <li class="page-item" :class="{ disabled: meta.current_page === 1 }">
                    <a class="page-link" href="#" @click.prevent="changePage(meta.current_page - 1)">
                        Prev
                    </a>
                </li>

                <!-- Pages -->
                <li v-for="page in pages" :key="page" class="page-item" :class="{ active: page === meta.current_page }">
                    <a class="page-link" href="#" @click.prevent="changePage(page)">
                        {{ page }}
                    </a>
                </li>

                <!-- Next -->
                <li class="page-item" :class="{ disabled: meta.current_page === meta.last_page }">
                    <a class="page-link" href="#" @click.prevent="changePage(meta.current_page + 1)">
                        Next
                    </a>
                </li>

            </ul>
        </nav>

    </div>
</template>

<script>
import axios from 'axios'

export default {
    props: {
        url: String,
        columns: Array,
        filters: {
            type: Array,
            default: () => []
        }
    },

    data() {
        return {
            rows: [],
            meta: {},
            loading: false,

            // 🔍 Search
            searchInput: '',
            search: '',
            debounceTimer: null,

            // 🎯 Dynamic filters
            filterValues: {},

            // Pagination + Sorting
            page: 1,
            sortField: '',
            sortDirection: 'asc'
        }
    },

    mounted() {
        this.initFilters()
        this.fetchData()
    },

    watch: {
        searchInput(val) {
            clearTimeout(this.debounceTimer)

            this.debounceTimer = setTimeout(() => {
                this.search = val
                this.page = 1
                this.fetchData()
            }, 500)
        }
    },

    computed: {
        pages() {
            if (!this.meta.last_page) return []

            let pages = []
            let start = Math.max(1, this.meta.current_page - 2)
            let end = Math.min(this.meta.last_page, this.meta.current_page + 2)

            for (let i = start; i <= end; i++) {
                pages.push(i)
            }

            return pages
        }
    },

    methods: {
        initFilters() {
            this.filters.forEach(f => {
                this.filterValues[f.model] = ''
            })
        },

        async fetchData() {
            this.loading = true

            const res = await axios.get(this.url, {
                params: {
                    page: this.page,
                    search: this.search,
                    ...this.filterValues,
                    sort: this.sortField,
                    direction: this.sortDirection
                }
            })

            this.rows = res.data.data
            this.meta = res.data
            this.loading = false
        },

        changePage(page) {
            if (page < 1 || page > this.meta.last_page) return
            this.page = page
            this.fetchData()
        },

        sort(field) {
            this.sortDirection = this.sortDirection === 'asc' ? 'desc' : 'asc'
            this.sortField = field
            this.fetchData()
        },

        getValue(obj, path) {
            return path.split('.').reduce((o, i) => o?.[i], obj)
        },

        badgeClass(status) {
            return {
                'bg-danger': status === 'denied',
                'bg-warning': status === 'pending' || status == 'pending_verification',
                'bg-success': status === 'approved' || status === 'paid' || status === 'released',
                'bg-info': status === 'ready_for_pickup' || status === 'unpaid',
                'bg-secondary': !status
            }
        }
    }
}
</script>