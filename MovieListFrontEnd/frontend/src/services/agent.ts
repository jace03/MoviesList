export async function askAgent(message: string, context: any = {}) {

  const res = await fetch("http://localhost:8000/api/agent", {
    method: "POST",
    headers: { "Content-Type": "application/json" },
    body: JSON.stringify({ message, context }),
  });

  const data = await res.json();
  return data.reply;
}