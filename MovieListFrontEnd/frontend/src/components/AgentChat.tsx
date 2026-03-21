import { askAgent } from "../services/agent";

async function handleAsk() {
  const reply = await askAgent("Recommend a movie", { movies: movieList });
  console.log(reply);
}
