const easeInOut = t => t < 0.5
    ? 2 * t * t
    : -1 + (4 - 2 * t) * t


export {easeInOut}