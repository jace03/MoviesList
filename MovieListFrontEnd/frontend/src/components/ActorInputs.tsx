import React from 'react';

type Props = {
  value: string[];
  onChange: (names: string[]) => void;
};

export default function ActorInputs({ value, onChange }: Props) {
  const updateAt = (idx: number, val: string) => {
    const next = [...value];
    next[idx] = val;
    onChange(next);
  };

  const add = () => onChange([...value, '']);
  const remove = (idx: number) => onChange(value.filter((_, i) => i !== idx));

  return (
    <div>
      <div className="space-y-2">
        {value.map((v, i) => (
          <div key={i} className="flex gap-2">
            <input
              type="text"
              className="flex-1 p-2 bg-gray-900 rounded"
              value={v}
              placeholder="Actor Name"
              onChange={e => updateAt(i, e.target.value)}
            />
            <button type="button" onClick={() => remove(i)} className="bg-red-600 px-3 rounded">-</button>
          </div>
        ))}
      </div>
      <div className="mt-2">
        <button type="button" onClick={add} className="bg-green-600 px-3 py-1 rounded">+ Add Actor</button>
      </div>
    </div>
  );
}

