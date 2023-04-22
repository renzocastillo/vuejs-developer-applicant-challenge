/**
 * Converts a Unix timestamp to a JavaScript Date object.
 *
 * @function
 * @param {number} unixDate - The Unix timestamp to convert.
 * @returns {Date} - A Date object representing the specified Unix timestamp.
 */
const toDate = (unixDate:number) => { return new Date(unixDate * 1000)}

export {toDate}