export async function documentFile(path: string) {
  const res = await fetch("http://localhost:8000/api/doc-agent", {
    method: "POST",
    headers: { "Content-Type": "application/json" },
    body: JSON.stringify({ target: path }),
  });

  const data = await res.json();
  return data.reply;
}