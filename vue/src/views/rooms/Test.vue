<template>
    <div>
        <!-- Home component included -->
       <Home>
          <h1>Sample Heading</h1>
       </Home>
          

        <!-- h1 tag for display -->
    </div>
    <div>
    </div>
    
</template>

<script>
// Import Axios for HTTP requests
import axios from "axios";

// Import the Home component
import Home from "../../components/Home.vue";

export default {
    components: {
        Home
    },
    data() {
        return {
            searchQuery: "",
            headers: [5],
            rooms: [],
            page: 1,
            showModal: false,
            // ... other data properties
        };
    },
    mounted() {
        // Example of using Axios to fetch data on component mount
        this.fetchData();
    },
    methods: {
        fetchData() {
            // Replace with your API endpoint and logic
            axios.get('https://example.com/api/data')
                .then(response => {
                    this.rooms = response.data;
                    // ... handle your data
                })
                .catch(error => {
                    console.error('Error fetching data:', error);
                });
        },
        // ... other methods
    }
}
</script>

<style scoped>
/* Scoped CSS styles for this component */
h1 {
    color: rgb(255, 0, 89);
    /* Other styles for h1 */
}

/* Additional styles */
</style>
