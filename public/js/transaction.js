// const SaweriaClient = require("saweria");

const client = new SaweriaClient();

client.on("login", (user) => {
  console.log("Logged in as: ", user.username);
});

client.on("donations", (donations) => {
  console.log(donations);
});

client.login("syailendramuhammad@gmail.com", "15September1999");