/**
 * ! DEPRECATED - Use PriceCalc from script.js instead
 * Price Calculator
 * @author Tobias Röder
 * @version 0.2.0
 */
class PriceCalculator {
    constructor() {
        this.prices = [
            89,
            99,
            129,
            169,
            189,
            229,
            299,
            319,
            369,
            429
        ];

        this.propertyTaxPrices = [
            89,
            119,
            169,
            189,
            229,
            249,
            309
        ];
    }

    formatCurrency(number) {
        return number
            .toFixed(2)
            .replace('.', ',')
            .replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1.');
        
    }

    extractNumber(str) {
        return Number(
            parseInt(
                str.replace(/[^\d,]/g, '')
            ).toFixed(0)
        );
    }

    getPrice(bjeStr = 0) {
        let bje = this.extractNumber(bjeStr);
        let priceIndex = 0;

        if (bje === NaN)
            return 0;

        if (bje <= 8000) {
            priceIndex = 0;
        }
        else if (bje > 8000 && bje <= 16000) {
            priceIndex = 1;
        }
        else if (bje > 16000 && bje <= 25000) {
            priceIndex = 2;
        }
        else if (bje > 25000 && bje <= 37000) {
            priceIndex = 3;
        }
        else if (bje > 37000 && bje <= 50000) {
            priceIndex = 4;
        }
        else if (bje > 50000 && bje <= 80000) {
            priceIndex = 5;
        }
        else if (bje > 80000 && bje <= 110000) {
            priceIndex = 6;
        }
        else if (bje > 110000 && bje <= 150000) {
            priceIndex = 7;
        }
        else if (bje > 150000 && bje <= 200000) {
            priceIndex = 8;
        }
        // else if (bje > 200000 && bje <= 250000) {
        else if (bje > 200000) {
            priceIndex = 9;
        }
        // else if (bje > 250000) {
        //     return false;
        // }
        else {
            return false;
        }

        return this.prices[priceIndex];
    }

    getPropertyTaxPrice(propertyTaxString = 0) {
        let propertyTax = this.extractNumber(propertyTaxString);
        let priceIndex = 0;

        if (propertyTax === NaN)
            return 0;

        if (propertyTax <= 65000)
            priceIndex = 0;
        else if (propertyTax <= 125000)
            priceIndex = 1;
        else if (propertyTax <= 200000)
            priceIndex = 2;
        else if (propertyTax <= 350000)
            priceIndex = 3;
        else if (propertyTax <= 500000)
            priceIndex = 4;
        else if (propertyTax <= 1000000)
            priceIndex = 5;
        // else if (propertyTax <= 5000000)
        else if (propertyTax > 1000000)
            priceIndex = 6;
        else
            return false;

        return this.propertyTaxPrices[priceIndex];
    }

    render() {
        this.bjeResult.innerHTML 
    }
}