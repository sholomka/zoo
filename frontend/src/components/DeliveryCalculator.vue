<template>
  <div class="container">
    <form @submit.prevent="calculateCost" class="form">
      <div class="form-group">
        <label for="weight">Weight:</label>
        <input type="number" v-model="weight" id="weight" step="0.01" required />
      </div>

      <div class="form-group">
        <label for="carrier">Carrier:</label>
        <select v-model="carrier" id="carrier" required>
          <option value="trans_company">TransCompany</option>
          <option value="pack_group">PackGroup</option>
        </select>
      </div>

      <button type="submit" class="btn">Calculate</button>
    </form>

    <div v-if="errors.length > 0" class="error-messages">
      <ul>
        <li v-for="error in errors" :key="error.field">{{ error.field }}: {{ error.message }}</li>
      </ul>
    </div>

    <div v-if="cost !== null" class="result">
      <p>Cost: {{ cost }} EUR</p>
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      carrier: '',
      weight: null,
      cost: null,
      errors: [],
    };
  },
  methods: {
    async calculateCost() {
      this.errors = [];
      this.cost = null;
      try {
        const response = await fetch('/api/calculate', {
          method: 'POST',
          headers: {
            'Content-Type': 'application/json',
          },
          body: JSON.stringify({
            carrier: this.carrier,
            weight: this.weight,
          }),
        });

        const data = await response.json();

        if (response.ok) {
          this.cost = data.cost;
        } else if (response.status === 400) {
          this.errors = data.errors;
        } else {
          console.error('An unexpected error occurred.');
        }
      } catch (error) {
        console.error('Error:', error);
      }
    },
  },
};
</script>

<style>
.container {
  max-width: 500px;
  margin: 0 auto;
  padding: 20px;
  border: 1px solid #ccc;
  border-radius: 8px;
  box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
}

.form-group {
  margin-bottom: 15px;
}

label {
  display: block;
  margin-bottom: 5px;
  font-weight: bold;
}

input[type="number"],
select {
  width: calc(100% - 20px);
  padding: 8px 10px;
  border: 1px solid #ccc;
  border-radius: 4px;
  box-sizing: border-box;
}

.btn {
  display: inline-block;
  padding: 10px 20px;
  font-size: 16px;
  color: #fff;
  background-color: #007bff;
  border: none;
  border-radius: 4px;
  cursor: pointer;
}

.btn:hover {
  background-color: #0056b3;
}

.error-messages {
  margin-top: 20px;
  color: red;
}

.result {
  margin-top: 20px;
  font-size: 18px;
  font-weight: bold;
}
</style>
