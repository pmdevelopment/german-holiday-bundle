//Paste into dev console on https://cebus.net/de/plz-bundesland.htm
(function () {
    const mapping = {
        'BADEN-WUERTTEMBERG': 'BADEN_WUERTTEMBERG',
        'BAYERN': 'BAVARIA',
        'BERLIN': 'BERLIN',
        'BRANDENBURG': 'BRANDENBURG',
        'BREMEN': 'BREMEN',
        'HAMBURG': 'HAMBURG',
        'HESSEN': 'HESSE',
        'MECKLENBURG-VORPOMMERN': 'MECKLENBURG_WESTERN_POMERANIA',
        'NIEDERSACHSEN': 'LOWER_SAXONY',
        'NORDRHEIN-WESTFALEN': 'NORTHRHINE_WESTPHALIA',
        'RHEINLAND-PFALZ': 'RHINELAND_PALATINATE',
        'SAARLAND': 'SAARLAND',
        'SACHSEN': 'SAXONY',
        'SACHSEN-ANHALT': 'SAXONY_ANHALT',
        'SCHLESWIG-HOLSTEIN': 'SCHLESWIG_HOLSTEIN',
        'THUERINGEN': 'THURINGIA'
    };

    const zipRanges = {};

    document.querySelectorAll('p').forEach(p => {
        const text = p.innerText || p.textContent;
        const matches = text.matchAll(/(\d{5})-(\d{5})\s+([^\n]+)/g);

        for (const match of matches) {
            const from = parseInt(match[1], 10);
            const to = parseInt(match[2], 10);
            let rawLand = match[3].trim();

            // Normalize
            let land = rawLand.toUpperCase()
                .replace(/[–—]/g, '-')  // Normalize dashes
                .replace('Ü', 'UE')
                .replace('Ä', 'AE')
                .replace('Ö', 'OE')
                .replace('ß', 'SS')
                .replace(/\s+/g, '-');

            const constant = mapping[land];
            if (!constant) {
                console.warn("Unknown Bundesland:", land);
                continue;
            }

            if (!zipRanges[constant]) zipRanges[constant] = [];
            zipRanges[constant].push([from, to]);
        }
    });

    // Generate PHP
    let php = "<?php\n\n$zipBundeslandRanges = [\n";
    for (const [state, ranges] of Object.entries(zipRanges)) {
        php += `    States::${state} => [\n`;
        php += ranges.map(r => `        [${r[0]}, ${r[1]}]`).join(",\n");
        php += "\n    ],\n";
    }
    php += "];\n";

    console.log(php);
})();