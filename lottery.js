/* fisher-yates shuffle */
const shuffle = (array) => {
    const res = [...array];
    for (let i = res.length - 1; i >= 1; i--) {
        const j = Math.floor(Math.random() * (i + 1));
        [res[j], res[i]] = [res[i], res[j]];
    }
    return res;
};

/*
ちゃんとシャッフルできてるか確認
const array = [0, 1, 2, 3, 4, 5, 6, 7, 8, 9];
let result = [0, 0, 0, 0, 0, 0, 0, 0, 0, 0];
for (const _ of Array(1000)) {
    const tmp = shuffle(array);
    result = result.map((n, i) => n + tmp[i]);
}
console.log(result);
*/

const lottery = (itemNumbers, ninjaNumber) => {
    /* 0 から ninjaNunber - 1 までのnumberのarray */
    const ninjaArray = [...Array(ninjaNumber).keys()];
    const shuffledNinjaArray = shuffle(ninjaArray);

    const winner = [];
    let start = 0;
    for (const itemNumber of itemNumbers) {
        winner.push(shuffledNinjaArray.slice(start, start + itemNumber));
        start += itemNumber;
    }
    
    return winner;
};

const itemNumbers = [
    9, /* micro:bit */
    3, /* micro:bit v1 */
    3, /* Raspberry Pi公式Tシャツ */
    1, /* 米 */
    4, /* Scratchドリル Tシャツ */
    5, /* はじめようAIプログラミング 冊子 */
    1, /* Apitor(未開封新品) */
    3, /* 書籍 */
];

const ninjaNumber = 100;

console.log(lottery(itemNumbers, ninjaNumber))